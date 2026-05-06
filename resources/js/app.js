import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.data("cart", () => ({
    open: false,
    items: JSON.parse(localStorage.getItem("cart_items") || "[]"),
    buyerName: "",
    paymentMethod: "CASH",
    init() {
        this.$watch("items", (value) => {
            localStorage.setItem("cart_items", JSON.stringify(value));
        });
    },
    addItem(payload) {
        const existing = this.items.find((i) => i.id === payload.id);
        if (existing) {
            existing.quantity = Math.min(
                (existing.quantity || 0) + (payload.quantity || 1),
                payload.stock ?? 99999,
            );
        } else {
            this.items.push({
                id: payload.id,
                name: payload.name,
                price: payload.price,
                quantity: payload.quantity || 1,
            });
        }
    },
    remove(id) {
        this.items = this.items.filter((i) => i.id !== id);
    },
    updateQuantity(id, qty) {
        const it = this.items.find((i) => i.id === id);
        if (!it) return;
        it.quantity = Math.max(1, parseInt(qty) || 1);
    },
    get total() {
        return this.items.reduce((s, i) => s + i.price * i.quantity, 0);
    },
    async checkout() {
        if (!this.items.length) {
            alert("Cart kosong");
            return;
        }

        const token = document
            .querySelector('meta[name="csrf-token"]')
            ?.getAttribute("content");

        const body = {
            buyer_name: this.buyerName,
            payment_method: this.paymentMethod,
            items: this.items.map((i) => ({
                menu_id: i.id,
                quantity: i.quantity,
            })),
        };

        const res = await fetch("/cart/checkout", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": token || "",
                Accept: "application/json",
            },
            body: JSON.stringify(body),
        });

        if (!res.ok) {
            const data = await res.json().catch(() => ({}));
            alert(data.message || "Gagal checkout");
            return;
        }

        const data = await res.json();
        this.items = [];
        window.location.href =
            data.redirect || `/transaction/${data.transaction}/success`;
    },
}));

Alpine.start();
