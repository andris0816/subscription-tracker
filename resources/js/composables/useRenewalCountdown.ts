import {computed} from "vue";

export function useRenewalCountdown(renewalDate: string | Date) {
    const timeUntil = computed(() => {
        const now = new Date();
        const date = new Date(renewalDate);

        const diffMs = date.getTime() - now.getTime();
        if (diffMs <= 0) return "Already Renewed";

        const diffDays = Math.floor(diffMs / (1000 * 60 * 60 * 24));
        const diffWeeks = Math.floor(diffDays / 7);
        const diffMonths = Math.floor(diffDays / 30);
        const diffYears = Math.floor(diffDays / 365);

        if (diffYears > 0) return `${diffYears} year${diffYears > 1 ? "s" : ""} until renewal`;
        if (diffMonths > 0) return `${diffMonths} month${diffMonths > 1 ? "s" : ""} until renewal`;
        if (diffWeeks > 0) return `${diffWeeks} week${diffWeeks > 1 ? "s" : ""} until renewal`;
        if (diffDays > 0) return `${diffDays} day${diffDays > 1 ? "s" : ""} until renewal`;

        const diffHours = Math.floor(diffMs / (1000 * 60 * 60));
        if (diffHours > 0) return `${diffHours} hour${diffHours > 1 ? "s" : ""} until renewal`;

        const diffMinutes = Math.floor(diffMs / (1000 * 60));
        if (diffMinutes > 0) return `${diffMinutes} minute${diffMinutes > 1 ? "s" : ""} until renewal`;

        const diffSeconds = Math.floor(diffMs / 1000);
        if (diffSeconds > 0) return `${diffSeconds} second${diffSeconds > 1 ? "s" : ""} until renewal`;
    });

    return { timeUntil };
}
