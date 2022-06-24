const path = require("path");
module.exports = {
	i18n: {
		locales: ["en", "de", "ar", "mn"],
		defaultLocale: "mn",
	},
	localePath: path.resolve("./public/locales"),
  reloadOnPrerender: process.env.NODE_ENV === 'development',
};
