export default function formatNumber(num) {
    // Check if the number is less than 1000
    if (num < 1000) {
        return num.toString();
    }

    // Define the suffixes and thresholds
    const suffixes = ['k', 'M', 'G'];
    const thresholds = [1000, 1000000, 1000000000];

    // Iterate over the thresholds to determine the appropriate suffix
    for (let i = thresholds.length - 1; i >= 0; i--) {
        if (num >= thresholds[i]) {
            const value = num / thresholds[i];
            const wholePart = Math.floor(value);
            const decimalPart = Math.floor((value - wholePart) * 10); // Get the first decimal digit
            return decimalPart > 0 ? `${wholePart}${suffixes[i]}${decimalPart}` : `${wholePart}${suffixes[i]}`;
        }
    }

    // Fallback (should not be reached)
    return num.toString();
}



