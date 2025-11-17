import {Currency} from "@/types/currency.types";

export interface Subscription {
    id: number,
    name: string,
    price: number,
    currency: Currency,
    renewalDate: Date,
    billingCycle: string,
    cancelUrl: string,
    createdAt: Date,
    updatedAt: Date,
}
