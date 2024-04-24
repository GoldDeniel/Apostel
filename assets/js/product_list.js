// get buttons and add event listener
const buttons = document.querySelectorAll('.add-to-cart-button');
buttons.forEach(button => {
    console.log(button);
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        console.log(productId);
        fetch('/cart/add/' + productId, {
            method: 'POST'
        }).then(response => {
            return response.json();
        }).then(data => {
            console.log(data);
            if (data.success) {
                const cartCount = document.querySelector('#cart-count');
                cartCount.innerHTML = data.cartCount;
            }
        }).catch(error => {
            console.log(error)
            });
    });
});