import {Currency} from "@/types/currency.types";

export interface Subscription {
    id: number,
    name: string,
    price: number,
    currency: Currency,
    renewal_date: Date,
    billing_cycle: string,
    cancel_url: string,
    created_at: Date,
    updated_at: Date,
}
