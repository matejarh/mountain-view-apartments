
export const Globals = {
    install: (v) => {
        v.config.globalProperties.delay = function(ms) {
            return new Promise(resolve => setTimeout(resolve, ms));
        }
    },
};
