export const convertToPascalCase = (string) => {
    return string
        .split('_')
        .map(word => word.charAt(0).toUpperCase() + word.slice(1))
        .join('');
}
