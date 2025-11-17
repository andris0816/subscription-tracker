export const currencies: readonly string[] = [
    "HUF",
    "EUR",
    "USD"
]

export type Currency = typeof currencies[number];
