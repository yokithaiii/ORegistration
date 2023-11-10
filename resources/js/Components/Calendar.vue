<template>
    <div class="text-center section">
        <h2 class="h2">Custom Calendars</h2>
        <p class="text-lg font-medium text-gray-600 mb-6">
            Roll your own calendars using scoped slots
        </p>
        <div class="custom-calendar vc-container max-w-full">
            <v-calendar
                class="custom-calendar max-w-full"
                :masks="masks"
                :attributes="attributes"
                disable-page-swipe
                is-expanded
            >
                <template v-slot:day-content="{ day, attributes }">
                    <div class="flex flex-col h-full z-10 overflow-hidden">
                        <span class="day-label text-sm text-gray-900">{{ day.day }}</span>
                        <div class="flex-grow overflow-y-auto overflow-x-auto">
                            <div class="calendar__event rounded mb-1" v-for="attr in attributes" :key="attr.time" :class="attr.customData.class">
                                <div class="calendar__event-text"><span>{{attr.customData.title}}</span></div>
                                <div class="calendar__event-time"><span>{{attr.customData.time}}</span></div>
                            </div>
                        </div>
                    </div>
                </template>
            </v-calendar>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        const month = new Date().getMonth();
        const year = new Date().getFullYear();
        return {
            masks: {
                weekdays: 'WWW',
                title: "MMMM"
            },
            attributes: [
                {
                    key: 1,
                    customData: {
                        title: 'Lunch with mom.',
                        time: '12:00',
                        class: 'bg-green-600 text-white p-1',
                    },
                    dates: new Date(year, month, 1),
                },
                {
                    key: 2,
                    customData: {
                        title: 'Jerk off',
                        time: '14:00',
                        class: 'bg-blue-600 text-white p-1',
                    },
                    dates: new Date(year, month, 1),
                },
            ],
        };
    },
    async mounted(){
        let formData = new FormData();

        let res = await fetch('/api/calendar/get/', {
            method: 'POST',
            body: formData,
        });

        let json = await res.json();
        this.attributes = json.data;
    }
};
</script>

<style>
/* Remove scrollbar */
::-webkit-scrollbar {
    width: 0px;
}

::-webkit-scrollbar-track {
    display: none;
}

/* Calendar styling */
.custom-calendar {
    --day-border: 1px solid #b8c2cc;
    --day-border-highlight: 1px solid #b8c2cc;
    --day-width: 90px;
    --day-height: 90px;
    --weekday-bg: #f8fafc;
    --weekday-border: 1px solid #eaeaea;

    border-radius: 0;
    width: 100%;
}

.custom-calendar .vc-header {
    background-color: #f1f5f8;
    padding: 10px 0;
    height: auto;
}

.vc-header .vc-title {
    opacity: 0.75;
}

.custom-calendar .vc-weeks {
    padding: 0;
}

.custom-calendar .vc-weekday {
    background-color: var(--weekday-bg);
    border-bottom: var(--weekday-border);
    border-top: var(--weekday-border);
    padding: 5px 0;
}

.custom-calendar .vc-day {
    padding: 5px;
    text-align: left;
    min-height: 100px;
    height: auto;
    min-width: var(--day-width);
    background-color: white;
}

.custom-calendar .vc-day.is-today {
    background-color: #fff85b;
}

.custom-calendar .vc-day.weekday-1,
.custom-calendar .vc-day.weekday-7 {
    background-color: #eff8ff;
}

.custom-calendar .vc-day:not(.on-bottom) {
    border-bottom: var(--day-border);
}

.custom-calendar .vc-day:not(.on-right) {
    border-right: var(--day-border);
}

.custom-calendar .vc-day.weekday-1:not(.on-bottom) {
    border-bottom: var(--day-border-highlight);
}

.custom-calendar .vc-day-dots {
    margin-bottom: 5px;
}

</style>
