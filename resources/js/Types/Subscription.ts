export interface Subscription {
    id: number,
    name: string,
    price: number,
    renewalDate: Date,
    billingCycle: string,
    cancelUrl: string,
    createdAt: Date,
    updatedAt: Date,
}
