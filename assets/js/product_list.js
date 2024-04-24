// this code is wet not dry
const cart_buttons = document.querySelectorAll('.add-to-cart-button');
cart_buttons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('data-product-id');
        console.log(productId);
        fetch('/cart/add' + productId, {
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
const favorite_buttons = document.querySelectorAll('.add-to-favorite-button');
favorite_buttons.forEach(button => {
    change_to_add_favorite_button(button);
    // button.addEventListener('click', function() {
    //     const productId = this.getAttribute('product_id');
    //     console.log('Sending data:', {beer_id: productId}); // Log the data being sent
    //     fetch('add_favorite.php', {
    //         method: 'POST',
    //         headers: {
    //             'Content-Type': 'application/json',
    //         },
    //         body: JSON.stringify({beer_id: productId})
    //     }).then(response => {
    //         return response.json();
    //     }).then(data => {
    //         console.log(data);
    //         if (data.success) {
    //             console.log('success');
    //             // switch button to remove from favorite
    //             change_to_remove_favorite_button(button);
    //         }
    //     }).catch(error => {
    //         console.log(error)
    //     });
    // });
});

const remove_favorite_buttons = document.querySelectorAll('.remove-favorite-button');
remove_favorite_buttons.forEach(button => {
    change_to_remove_favorite_button(button);
})

function change_to_remove_favorite_button(button) {
    button.innerHTML = 'Remove from favorites';
    button.classList.remove('add-to-favorite-button');
    button.classList.add('remove-from-favorite-button');
    button.classList.add('btn-danger');
    button.classList.remove('btn-warning');

    button.addEventListener('click', function() {
        const productId = this.getAttribute('product_id');
        console.log('Sending data:', {beer_id: productId}); // Log the data being sent
        fetch('remove_favorite.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({beer_id: productId})
        }).then(response => {
            return response.json();
        }).then(data => {
            console.log(data);
            if (data.success) {
                console.log('success');
                // switch button to remove from favorite
                change_to_add_favorite_button(button);
            }
        }).catch(error => {
            console.log(error)
        });
    });
}

function change_to_add_favorite_button(button) {
    button.innerHTML = 'Add to favorites';
    button.classList.remove('remove-from-favorite-button');
    button.classList.add('add-to-favorite-button');
    button.classList.remove('btn-danger');
    button.classList.add('btn-warning');

    button.addEventListener('click', function() {
        const productId = this.getAttribute('product_id');
        console.log('Sending data:', {beer_id: productId}); // Log the data being sent
        fetch('add_favorite.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({beer_id: productId})
        }).then(response => {
            return response.json();
        }).then(data => {
            console.log(data);
            if (data.success) {
                console.log('success');
                // switch button to remove from favorite
                change_to_remove_favorite_button(button);
            }
        }).catch(error => {
            console.log(error)
        });
    });
}
