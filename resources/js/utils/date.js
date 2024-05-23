import { formatDistanceToNow, formatDate } from 'date-fns';
import { fr, enUS, de, sl, it, hu, cs } from 'date-fns/locale';

// Map of available locales
const locales = { en: enUS, fr: fr, de: de, sl: sl, it: it, hu: hu, cs: cs };

export const getFormattedDate = (date, localeKey) => {
    if (date === null || date === 'undefined') {
        return 'Not yet'
    }
    const locale = locales[localeKey] || enUS;
    return formatDistanceToNow(date, { addSuffix: true, locale: locale });
}

export const getLocalizedDate = (date, localeKey) => {
    if (date === null || date === 'undefined') {
        return 'No date provided'
    }
    const locale = locales[localeKey] || enUS;
    return formatDate(date, { addSuffix: true, locale: locale });
}
