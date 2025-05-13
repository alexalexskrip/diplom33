export default function sliderData() {
    return {
        active: 0,
        itemsPerView: 3,
        items: [],
        intervalId: null,

        init() {
            this.items = window.__sliderData?.initiatives ?? [];
            // this.startAutoplay();
        },

        startAutoplay() {
            this.intervalId = setInterval(() => {
                this.next();
            }, 5000);
        },

        visibleItems() {
            return this.items.slice(this.active, this.active + this.itemsPerView);
        },

        next() {
            this.active++;
            if (this.active + this.itemsPerView > this.items.length) {
                this.active = 0;
            }
        },

        prev() {
            this.active--;
            if (this.active < 0) {
                this.active = this.items.length - this.itemsPerView;
            }
        }
    };
}
