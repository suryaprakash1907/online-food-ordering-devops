let cart = JSON.parse(localStorage.getItem("cart")) || [];

function saveCart() {
    localStorage.setItem("cart", JSON.stringify(cart));
}

function updateCartCount() {

    let count = 0;

    cart.forEach(item => {
        count += item.quantity;
    });

    const badge = document.getElementById("cartCount");

    if (badge) {
        badge.innerText = count;
    }

}

function addToCart(id, name, price) {

    const existing = cart.find(item => item.id === id);

    if (existing) {

        existing.quantity++;

    } else {

        cart.push({

            id: id,

            name: name,

            price: parseFloat(price),

            quantity: 1

        });

    }

    saveCart();

    updateCartCount();

   showToast(name + " added to cart.");

}

window.onload = function () {

    updateCartCount();

}


function showToast(message){

    const toast=document.getElementById("toast");

    toast.innerHTML="✅ "+message;

    toast.classList.add("show");

    setTimeout(function(){

        toast.classList.remove("show");

    },3000);

}