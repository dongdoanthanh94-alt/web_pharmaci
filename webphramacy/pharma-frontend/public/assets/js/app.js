(() => {
    const money = new Intl.NumberFormat('vi-VN', { maximumFractionDigits: 0 });
    const labels = {
        overview: 'Tổng quan',
        pos: 'Bán hàng POS',
        inventory: 'Quản lý kho',
        prescriptions: 'Đơn thuốc',
        reminders: 'Lịch nhắc uống thuốc',
        medicines: 'Danh mục thuốc',
        orders: 'Đơn hàng',
        customers: 'Khách hàng',
        reports: 'Báo cáo'
    };
    const genericViews = new Set(['medicines', 'orders', 'customers', 'reports', 'reminders']);
    const navItems = document.querySelectorAll('.nav-item');
    const panels = document.querySelectorAll('.view-panel');
    const toast = document.getElementById('toast');
    const cart = new Map();
    let discount = 0;
    let toastTimer;

    const showToast = (message) => {
        toast.textContent = message;
        toast.classList.add('show');
        window.clearTimeout(toastTimer);
        toastTimer = window.setTimeout(() => toast.classList.remove('show'), 2800);
    };

    const setView = (view) => {
        const knownView = labels[view] ? view : 'overview';
        panels.forEach((panel) => panel.classList.add('hidden'));
        const panelId = genericViews.has(knownView) ? 'view-generic' : `view-${knownView}`;
        document.getElementById(panelId)?.classList.remove('hidden');
        navItems.forEach((item) => item.classList.toggle('active', item.dataset.view === knownView));
        document.getElementById('breadcrumbCurrent').textContent = labels[knownView];
        if (genericViews.has(knownView)) {
            document.getElementById('genericTitle').textContent = labels[knownView];
            document.getElementById('genericHeading').textContent = labels[knownView];
        }
        document.getElementById('sidebar').classList.remove('open');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    navItems.forEach((item) => item.addEventListener('click', () => setView(item.dataset.view)));
    document.querySelectorAll('[data-open-view]').forEach((button) => {
        button.addEventListener('click', () => setView(button.dataset.openView));
    });

    document.getElementById('mobileMenu').addEventListener('click', () => {
        document.getElementById('sidebar').classList.toggle('open');
    });

    document.addEventListener('keydown', (event) => {
        if ((event.metaKey || event.ctrlKey) && event.key.toLowerCase() === 'k') {
            event.preventDefault();
            document.getElementById('globalSearch').focus();
        }
        if (event.key === 'F2') {
            event.preventDefault();
            setView('pos');
            document.getElementById('barcodeSearch').focus();
        }
        if (event.key === 'F3' && !document.getElementById('view-pos').classList.contains('hidden')) {
            event.preventDefault();
            document.getElementById('barcodeSearch').focus();
        }
        if (event.key === 'Escape') closeStockModal();
    });

    document.getElementById('globalSearch').addEventListener('keydown', (event) => {
        if (event.key === 'Enter') {
            const query = event.currentTarget.value.trim();
            if (!query) return;
            setView('inventory');
            const inventorySearch = document.getElementById('inventorySearch');
            inventorySearch.value = query;
            inventorySearch.dispatchEvent(new Event('input'));
        }
    });

    const updateCart = () => {
        const container = document.getElementById('cartItems');
        container.replaceChildren();
        if (cart.size === 0) {
            const empty = document.createElement('div');
            empty.className = 'empty-cart';
            empty.innerHTML = '<span>🛒</span><strong>Chưa có sản phẩm</strong><small>Chọn thuốc để thêm vào đơn hàng</small>';
            container.append(empty);
        } else {
            cart.forEach((item, id) => {
                const row = document.createElement('div');
                row.className = 'cart-line';
                row.innerHTML = `<div><div class="cart-line-name"></div><div class="cart-line-controls"><div class="qty-control"><button type="button" data-qty="-1" aria-label="Giảm số lượng">−</button><span>${item.quantity}</span><button type="button" data-qty="1" aria-label="Tăng số lượng">+</button></div><button type="button" class="remove-line">Xóa</button></div></div><strong class="cart-line-price">${money.format(item.price * item.quantity)} ₫</strong>`;
                row.querySelector('.cart-line-name').textContent = item.name;
                row.querySelector('[data-qty="-1"]').addEventListener('click', () => changeQuantity(id, -1));
                row.querySelector('[data-qty="1"]').addEventListener('click', () => changeQuantity(id, 1));
                row.querySelector('.remove-line').addEventListener('click', () => {
                    cart.delete(id);
                    updateCart();
                });
                container.append(row);
            });
        }
        const subtotal = [...cart.values()].reduce((sum, item) => sum + item.price * item.quantity, 0);
        const total = Math.max(0, subtotal - discount);
        document.getElementById('subtotal').textContent = `${money.format(subtotal)} ₫`;
        document.getElementById('total').textContent = `${money.format(total)} ₫`;
        document.getElementById('checkoutTotal').textContent = `${money.format(total)} ₫`;
        document.getElementById('checkoutButton').disabled = cart.size === 0;
    };

    const changeQuantity = (id, amount) => {
        const item = cart.get(id);
        if (!item) return;
        item.quantity += amount;
        if (item.quantity <= 0) cart.delete(id);
        updateCart();
    };

    const addProduct = (product) => {
        const existing = cart.get(product.id);
        if (existing) existing.quantity += 1;
        else cart.set(product.id, { ...product, quantity: 1 });
        updateCart();
        showToast(`${product.name} đã được thêm vào đơn.`);
    };

    document.querySelectorAll('.product-card').forEach((button) => {
        button.addEventListener('click', () => addProduct({
            id: button.dataset.id,
            name: button.dataset.name,
            price: Number(button.dataset.price)
        }));
    });

    document.getElementById('barcodeSearch').addEventListener('keydown', (event) => {
        if (event.key !== 'Enter') return;
        const query = event.currentTarget.value.trim().toLocaleLowerCase('vi');
        if (!query) return;
        const match = [...document.querySelectorAll('.product-card')].find((card) =>
            card.dataset.name.toLocaleLowerCase('vi').includes(query) ||
            card.dataset.id.toLocaleLowerCase('vi') === query
        );
        if (match) {
            addProduct({ id: match.dataset.id, name: match.dataset.name, price: Number(match.dataset.price) });
            event.currentTarget.value = '';
        } else {
            showToast('Không tìm thấy sản phẩm. Kết nối API để tra cứu mã vạch.');
        }
    });

    document.getElementById('clearCart').addEventListener('click', () => {
        cart.clear();
        discount = 0;
        document.getElementById('discountButton').textContent = '＋ Thêm giảm giá';
        updateCart();
    });

    document.querySelectorAll('.payment-option').forEach((button) => {
        button.addEventListener('click', () => {
            document.querySelectorAll('.payment-option').forEach((option) => option.classList.remove('selected'));
            button.classList.add('selected');
        });
    });

    document.getElementById('discountButton').addEventListener('click', () => {
        const amount = window.prompt('Nhập số tiền giảm giá (VNĐ):', '0');
        if (amount === null) return;
        const parsed = Number(amount);
        if (!Number.isFinite(parsed) || parsed < 0) {
            showToast('Vui lòng nhập số tiền giảm giá hợp lệ.');
            return;
        }
        discount = parsed;
        document.getElementById('discountButton').textContent = `− ${money.format(discount)} ₫`;
        updateCart();
    });

    document.getElementById('checkoutButton').addEventListener('click', async () => {
        const order = {
            customerName: document.getElementById('customerName').value.trim() || null,
            paymentMethod: document.querySelector('.payment-option.selected').dataset.payment,
            items: [...cart.values()].map(({ id, quantity }) => ({ medicineId: Number(id), quantity })),
            discountAmount: discount
        };
        try {
            const response = await fetch(`${window.PHARMACY_API_BASE_URL}/pos/orders`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(order)
            });
            if (!response.ok) throw new Error(`API trả về HTTP ${response.status}`);
            showToast('Đã gửi đơn hàng tới hệ thống.');
            cart.clear();
            discount = 0;
            document.getElementById('discountButton').textContent = '＋ Thêm giảm giá';
            updateCart();
        } catch (error) {
            console.error('Không thể tạo đơn hàng:', error);
            showToast(error.message.startsWith('API trả về HTTP')
                ? `Không thể thanh toán: ${error.message}. Đơn chưa được ghi nhận.`
                : 'Chưa kết nối được API. Đơn hàng chưa được ghi nhận.');
        }
    });

    document.getElementById('inventorySearch').addEventListener('input', (event) => {
        const query = event.currentTarget.value.trim().toLocaleLowerCase('vi');
        document.querySelectorAll('#inventoryTable tbody tr').forEach((row) => {
            row.classList.toggle('hidden', !row.dataset.search.includes(query));
        });
    });

    const modal = document.getElementById('stockModal');
    const closeStockModal = () => modal.classList.add('hidden');
    document.getElementById('addStockButton').addEventListener('click', () => modal.classList.remove('hidden'));
    document.querySelectorAll('[data-close-modal]').forEach((button) => button.addEventListener('click', closeStockModal));
    modal.addEventListener('click', (event) => {
        if (event.target === modal) closeStockModal();
    });
    document.getElementById('stockForm').addEventListener('submit', async (event) => {
        event.preventDefault();
        const form = new FormData(event.currentTarget);
        const receipt = Object.fromEntries(form.entries());
        receipt.medicineId = Number(receipt.medicineId);
        receipt.quantity = Number(receipt.quantity);
        try {
            const response = await fetch(`${window.PHARMACY_API_BASE_URL}/inventory/receipts`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(receipt)
            });
            if (!response.ok) throw new Error(`API trả về HTTP ${response.status}`);
            showToast('Đã gửi phiếu nhập kho.');
            event.currentTarget.reset();
            closeStockModal();
        } catch (error) {
            console.error('Không thể ghi nhận phiếu nhập:', error);
            showToast(error.message.startsWith('API trả về HTTP')
                ? `Không thể nhập kho: ${error.message}. Phiếu chưa được ghi nhận.`
                : 'Chưa kết nối được API. Phiếu nhập chưa được ghi nhận.');
        }
    });

    document.querySelectorAll('.review-button').forEach((button) => {
        button.addEventListener('click', () => showToast('Cần kết nối API để xem và thẩm định đơn thuốc.'));
    });
    document.querySelectorAll('.row-menu').forEach((button) => {
        button.addEventListener('click', () => showToast('Thao tác lô thuốc sẽ được mở rộng khi kết nối API.'));
    });
    document.querySelectorAll('.payment-option').forEach((button) => {
        button.setAttribute('type', 'button');
    });
    const requestedView = new URLSearchParams(window.location.search).get('view');
    if (requestedView && labels[requestedView]) setView(requestedView);
    updateCart();
})();
