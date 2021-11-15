const DATE_UNITS = {
    day: 86400,
    hour: 3600,
    minute: 60,
    second: 1,
};

const getSecondsDiff = (timestamp) => (Date.now() - timestamp) / 1000;

const getUnitAndValue = (secondsElapsed) => {
    for (const [unit, secondsInUnit] of Object.entries(DATE_UNITS)) {
        if (secondsElapsed >= secondsInUnit || unit === "second") {
            const value = Math.floor(secondsElapsed / secondsInUnit) * -1;

            return { value, unit };
        }
    }
};

const getTimeAgo = (timestamp) => {
    const rtf = new Intl.RelativeTimeFormat("es");
    const secondsElapsed = getSecondsDiff(timestamp);
    const { value, unit } = getUnitAndValue(secondsElapsed);

    return rtf.format(value, unit);
};

const getFormattedDate = (timestamp, style = { dateStyle: "medium" }) => {
    const dtf = new Intl.DateTimeFormat("es", style);
    return dtf.format(new Date(timestamp));
};
