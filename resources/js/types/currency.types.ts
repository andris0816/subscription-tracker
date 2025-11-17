export const currencies = [
    "HUF",
    "EUR",
    "USD"
] as const;

export type Currency = typeof currencies[number];
