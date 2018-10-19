import { Injectable } from '@nestjs/common';
import { InjectConnection } from '@nestjs/typeorm';
import { CreateRoleInput, Permission, UpdateRoleInput } from 'shared/generated-types';
import {
    CUSTOMER_ROLE_CODE,
    CUSTOMER_ROLE_DESCRIPTION,
    SUPER_ADMIN_ROLE_CODE,
    SUPER_ADMIN_ROLE_DESCRIPTION,
} from 'shared/shared-constants';
import { ID, PaginatedList } from 'shared/shared-types';
import { Connection } from 'typeorm';

import { ListQueryOptions } from '../../common/types/common-types';
import { assertFound } from '../../common/utils';
import { Role } from '../../entity/role/role.entity';
import { I18nError } from '../../i18n/i18n-error';
import { ListQueryBuilder } from '../helpers/list-query-builder/list-query-builder';
import { patchEntity } from '../helpers/patch-entity';

import { ChannelService } from './channel.service';

@Injectable()
export class RoleService {
    constructor(
        @InjectConnection() private connection: Connection,
        private channelService: ChannelService,
        private listQueryBuilder: ListQueryBuilder,
    ) {}

    async initRoles() {
        await this.ensureSuperAdminRoleExists();
        await this.ensureCustomerRoleExists();
    }

    findAll(options?: ListQueryOptions<Role>): Promise<PaginatedList<Role>> {
        return this.listQueryBuilder
            .build(Role, options, ['channels'])
            .getManyAndCount()
            .then(([items, totalItems]) => ({
                items,
                totalItems,
            }));
    }

    findOne(roleId: ID): Promise<Role | undefined> {
        return this.connection.manager.findOne(Role, roleId, {
            relations: ['channels'],
        });
    }

    getSuperAdminRole(): Promise<Role> {
        return this.getRoleByCode(SUPER_ADMIN_ROLE_CODE).then(role => {
            if (!role) {
                throw new I18nError(`error.super-admin-role-not-found`);
            }
            return role;
        });
    }

    getCustomerRole(): Promise<Role> {
        return this.getRoleByCode(CUSTOMER_ROLE_CODE).then(role => {
            if (!role) {
                throw new I18nError(`error.customer-role-not-found`);
            }
            return role;
        });
    }

    async create(input: CreateRoleInput): Promise<Role> {
        const role = new Role(input);
        role.channels = [this.channelService.getDefaultChannel()];
        return this.connection.manager.save(role);
    }

    async update(input: UpdateRoleInput): Promise<Role> {
        const role = await this.findOne(input.id);
        if (!role) {
            throw new I18nError(`error.entity-with-id-not-found`, { entityName: 'Role', id: input.id });
        }
        if (role.code === SUPER_ADMIN_ROLE_CODE || role.code === CUSTOMER_ROLE_CODE) {
            throw new I18nError(`error.cannot-modify-role`, { roleCode: role.code });
        }
        const updatedRole = patchEntity(role, input);
        await this.connection.manager.save(updatedRole);
        return assertFound(this.findOne(role.id));
    }

    private getRoleByCode(code: string): Promise<Role | undefined> {
        return this.connection.getRepository(Role).findOne({
            where: { code },
        });
    }

    private async ensureSuperAdminRoleExists() {
        try {
            await this.getSuperAdminRole();
        } catch (err) {
            await this.create({
                code: SUPER_ADMIN_ROLE_CODE,
                description: SUPER_ADMIN_ROLE_DESCRIPTION,
                permissions: Object.values(Permission),
            });
        }
    }

    private async ensureCustomerRoleExists() {
        try {
            await this.getCustomerRole();
        } catch (err) {
            await this.create({
                code: CUSTOMER_ROLE_CODE,
                description: CUSTOMER_ROLE_DESCRIPTION,
                permissions: [Permission.Authenticated],
            });
        }
    }
}
