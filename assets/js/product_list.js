
const cart_buttons = document.querySelectorAll('.add-to-cart-button');

const favorite_buttons = document.querySelectorAll('.add-to-favorite-button');
favorite_buttons.forEach(button => {
    change_to_add_favorite_button(button);
});

const remove_favorite_buttons = document.querySelectorAll('.remove-favorite-button');
remove_favorite_buttons.forEach(button => {
    change_to_remove_favorite_button(button);
})

// this code is wet not dry
cart_buttons.forEach(button => {
    button.addEventListener('click', function() {
        const productId = this.getAttribute('product_id');
        const quantity_selector = button.parentElement.querySelector('.quantity-selector');
        const quantity = quantity_selector.value;
        console.log(quantity);
        if (button.classList.contains('btn-success')) {
            // Ha a gomb zöld, akkor visszavonjuk a kosárba helyezést
            fetch('remove_from_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({beer_id: productId})
            }).then(response => {
                return response.json();
            }).then(data => {
                console.log(data);
                // Kosárba gomb visszaállítása eredeti állapotba
                button.innerHTML = "Kosárba";
                button.classList.remove("btn-success");
                button.classList.add("btn-primary");
            }).catch(error => {
                console.log(error);
            });
        } else {
            // Ha a gomb nem zöld, akkor a kosárba helyezzük
            fetch('add_to_cart.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({beer_id: productId, quantity: quantity})
            }).then(response => {
                return response.json();
            }).then(data => {
                console.log(data);
                // Kosárba gomb módosítása
                button.innerHTML = "Kosárban";
                button.classList.remove("btn-primary");
                button.classList.add("btn-success");
            }).catch(error => {
                console.log(error);
            });
        }
    });
});


function change_to_remove_favorite_button(button) {
    button.innerHTML = 'Törlés a kedvencekből';
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
    button.innerHTML = 'Kedvencekhez adás';
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
