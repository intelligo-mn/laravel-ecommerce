import { MiddlewareConsumer, NestModule, OnApplicationBootstrap, OnModuleDestroy } from '@nestjs/common';
import { DEFAULT_AUTH_TOKEN_HEADER_KEY } from '@vendure/common/lib/shared-constants';
import {
    AdminUiAppConfig,
    AdminUiAppDevModeConfig,
    AdminUiConfig,
    Type,
} from '@vendure/common/lib/shared-types';
import { ConfigService, createProxyHandler, Logger, PluginCommonModule, VendurePlugin } from '@vendure/core';
import express from 'express';
import fs from 'fs-extra';
import path from 'path';

import { defaultAvailableLanguages, defaultLanguage, DEFAULT_APP_PATH, loggerCtx } from './constants';

/**
 * @description
 * Configuration options for the {@link AdminUiPlugin}.
 *
 * @docsCategory AdminUiPlugin
 */
export interface AdminUiPluginOptions {
    /**
     * @description
     * The route to the admin ui.
     */
    route: string;
    /**
     * @description
     * The port on which the server will listen. If not
     */
    port: number;
    /**
     * @description
     * The hostname of the server serving the static admin ui files.
     *
     * @default 'localhost'
     */
    hostname?: string;
    /**
     * @description
     * By default, the AdminUiPlugin comes bundles with a pre-built version of the
     * Admin UI. This option can be used to override this default build with a different
     * version, e.g. one pre-compiled with one or more ui extensions.
     */
    app?: AdminUiAppConfig | AdminUiAppDevModeConfig;
    /**
     * @description
     * Allows the contents of the `vendure-ui-config.json` file to be set, e.g.
     * for specifying the Vendure GraphQL API host, available UI languages, etc.
     */
    adminUiConfig?: Partial<AdminUiConfig>;
}

/**
 * @description
 * This plugin starts a static server for the Admin UI app, and proxies it via the `/admin/` path of the main Vendure server.
 *
 * The Admin UI allows you to administer all aspects of your store, from inventory management to order tracking. It is the tool used by
 * store administrators on a day-to-day basis for the management of the store.
 *
 * ## Installation
 *
 * `yarn add \@vendure/admin-ui-plugin`
 *
 * or
 *
 * `npm install \@vendure/admin-ui-plugin`
 *
 * @example
 * ```ts
 * import { AdminUiPlugin } from '\@vendure/admin-ui-plugin';
 *
 * const config: VendureConfig = {
 *   // Add an instance of the plugin to the plugins array
 *   plugins: [
 *     AdminUiPlugin.init({ port: 3002 }),
 *   ],
 * };
 * ```
 *
 * @docsCategory AdminUiPlugin
 */
@VendurePlugin({
    imports: [PluginCommonModule],
    providers: [],
})
export class AdminUiPlugin implements NestModule {
    private static options: AdminUiPluginOptions;

    constructor(private configService: ConfigService) {}

    /**
     * @description
     * Set the plugin options
     */
    static init(options: AdminUiPluginOptions): Type<AdminUiPlugin> {
        this.options = options;
        return AdminUiPlugin;
    }

    async configure(consumer: MiddlewareConsumer) {
        const { app, hostname, port, route, adminUiConfig } = AdminUiPlugin.options;
        const adminUiAppPath = AdminUiPlugin.isDevModeApp(app)
            ? path.join(app.sourcePath, 'src')
            : (app && app.path) || DEFAULT_APP_PATH;
        const adminUiConfigPath = path.join(adminUiAppPath, 'vendure-ui-config.json');

        const overwriteConfig = () => {
            const uiConfig = this.getAdminUiConfig(adminUiConfig);
            return this.overwriteAdminUiConfig(adminUiConfigPath, uiConfig);
        };

        if (AdminUiPlugin.isDevModeApp(app)) {
            Logger.info('Creating admin ui middleware (dev mode)', loggerCtx);
            consumer
                .apply(
                    createProxyHandler({
                        hostname,
                        port,
                        route,
                        label: 'Admin UI',
                        basePath: route,
                    }),
                )
                .forRoutes(route);
            consumer
                .apply(
                    createProxyHandler({
                        hostname,
                        port,
                        route: 'sockjs-node',
                        label: 'Admin UI live reload',
                        basePath: 'sockjs-node',
                    }),
                )
                .forRoutes('sockjs-node');

            Logger.info(`Compiling Admin UI app in development mode`, loggerCtx);
            app.compile().then(
                () => {
                    Logger.info(`Admin UI compiling and watching for changes...`, loggerCtx);
                },
                (err: any) => {
                    Logger.error(`Failed to compile: ${err}`, loggerCtx, err.stack);
                },
            );
            await overwriteConfig();
        } else {
            Logger.info('Creating admin ui middleware (prod mode)', loggerCtx);
            consumer.apply(await this.createStaticServer(app)).forRoutes(route);

            if (app && typeof app.compile === 'function') {
                Logger.info(`Compiling Admin UI app in production mode...`, loggerCtx);
                app.compile()
                    .then(overwriteConfig)
                    .then(
                        () => {
                            Logger.info(`Admin UI successfully compiled`, loggerCtx);
                        },
                        (err: any) => {
                            Logger.error(`Failed to compile: ${err}`, loggerCtx, err.stack);
                        },
                    );
            } else {
                await overwriteConfig();
            }
        }
    }

    private async createStaticServer(app?: AdminUiAppConfig) {
        const adminUiAppPath = (app && app.path) || DEFAULT_APP_PATH;

        const adminUiServer = express.Router();
        adminUiServer.use(express.static(adminUiAppPath));
        adminUiServer.use((req, res) => {
            res.sendFile(path.join(adminUiAppPath, 'index.html'));
        });

        return adminUiServer;
    }

    /**
     * Takes an optional AdminUiConfig provided in the plugin options, and returns a complete
     * config object for writing to disk.
     */
    private getAdminUiConfig(partialConfig?: Partial<AdminUiConfig>): AdminUiConfig {
        const { authOptions } = this.configService;

        const propOrDefault = <Prop extends keyof AdminUiConfig>(
            prop: Prop,
            defaultVal: AdminUiConfig[Prop],
        ): AdminUiConfig[Prop] => {
            return partialConfig ? (partialConfig as AdminUiConfig)[prop] || defaultVal : defaultVal;
        };
        return {
            adminApiPath: propOrDefault('adminApiPath', this.configService.apiOptions.adminApiPath),
            apiHost: propOrDefault('apiHost', 'auto'),
            apiPort: propOrDefault('apiPort', 'auto'),
            tokenMethod: propOrDefault('tokenMethod', authOptions.tokenMethod || 'cookie'),
            authTokenHeaderKey: propOrDefault(
                'authTokenHeaderKey',
                authOptions.authTokenHeaderKey || DEFAULT_AUTH_TOKEN_HEADER_KEY,
            ),
            defaultLanguage: propOrDefault('defaultLanguage', defaultLanguage),
            availableLanguages: propOrDefault('availableLanguages', defaultAvailableLanguages),
            loginUrl: AdminUiPlugin.options.adminUiConfig?.loginUrl,
            brand: AdminUiPlugin.options.adminUiConfig?.brand,
            hideVendureBranding: propOrDefault(
                'hideVendureBranding',
                AdminUiPlugin.options.adminUiConfig?.hideVendureBranding || false,
            ),
            hideVersion: propOrDefault(
                'hideVersion',
                AdminUiPlugin.options.adminUiConfig?.hideVersion || false,
            ),
        };
    }

    /**
     * Overwrites the parts of the admin-ui app's `vendure-ui-config.json` file relating to connecting to
     * the server admin API.
     */
    private async overwriteAdminUiConfig(adminUiConfigPath: string, config: AdminUiConfig) {
        try {
            const content = await this.pollForConfigFile(adminUiConfigPath);
        } catch (e) {
            Logger.error(e.message, loggerCtx);
            throw e;
        }
        try {
            await fs.writeFile(adminUiConfigPath, JSON.stringify(config, null, 2));
        } catch (e) {
            throw new Error('[AdminUiPlugin] Could not write vendure-ui-config.json file:\n' + e.message);
        }
        Logger.verbose(`Applied configuration to vendure-ui-config.json file`, loggerCtx);
    }

    /**
     * It might be that the ui-devkit compiler has not yet copied the config
     * file to the expected location (particularly when running in watch mode),
     * so polling is used to check multiple times with a delay.
     */
    private async pollForConfigFile(adminUiConfigPath: string) {
        const maxRetries = 10;
        const retryDelay = 200;
        let attempts = 0;

        const pause = () => new Promise(resolve => setTimeout(resolve, retryDelay));

        while (attempts < maxRetries) {
            try {
                Logger.verbose(`Checking for config file: ${adminUiConfigPath}`, loggerCtx);
                const configFileContent = await fs.readFile(adminUiConfigPath, 'utf-8');
                return configFileContent;
            } catch (e) {
                attempts++;
                Logger.verbose(
                    `Unable to locate config file: ${adminUiConfigPath} (attempt ${attempts})`,
                    loggerCtx,
                );
            }
            await pause();
        }
        throw new Error(`Unable to locate config file: ${adminUiConfigPath}`);
    }

    private static isDevModeApp(
        app?: AdminUiAppConfig | AdminUiAppDevModeConfig,
    ): app is AdminUiAppDevModeConfig {
        if (!app) {
            return false;
        }
        return !!(app as AdminUiAppDevModeConfig).sourcePath;
    }
}
