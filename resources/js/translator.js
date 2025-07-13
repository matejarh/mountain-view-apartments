import { useTranslationsStore } from "./stores/translations";

export const Translator = {
    install: (v) => {
        const store = useTranslationsStore()

        v.config.globalProperties.__ = function (key, count = 1, replace = {}) {

            let translation = store.translations[key];

            // If the translation key does not exist, push it to store.missingKeys
            if (!translation) {
                // Use the key itself as the fallback translation
                translation = key;
                if (!store.missingKeys[key]) {

                    // const missingKey = { [key]: key };
                    store.addMissingKey(key)
                    // store.missingKeys.push(key);
                }
            }

            // Check if translation is a string
            if (typeof translation !== 'string') {
                console.error(`Translation for key "${key}" is not a string.`);
                return key;
            }

            // Parse the Laravel pluralization syntax
            const parts = translation.split('|');

            let pluralTranslation = null;

            parts.forEach(part => {
                const [condition, value] = part.split(':');
                const [start, end] = condition.split(',').map(Number);
                if (isNaN(start)) {
                    pluralTranslation = value;
                } else {
                    if ((isNaN(end) && count >= start) || (count >= start && count <= end)) {
                        pluralTranslation = value.replace('#count', count);
                    }
                }
            });

            // If plural translation is not found, use the original translation
            translation = pluralTranslation || translation;

            // Replace placeholders
            Object.keys(replace).forEach(function (key) {
                translation = translation.replaceAll(':' + key, replace[key]);
            });

            return translation;
        };
    },
};
