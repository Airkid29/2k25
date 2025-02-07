document.addEventListener("DOMContentLoaded", function () {
    let cart = JSON.parse(localStorage.getItem("cart")) || []; // Récupère le panier du stockage local
  
    // Sélectionne tous les boutons "Ajouter au panier"
    document.querySelectorAll(".add-to-cart").forEach((button) => {
      button.addEventListener("click", function () {
        let userLoggedIn = checkUserLogin(); // Vérifie si l'utilisateur est connecté
  
        if (!userLoggedIn) {
          window.location.href = "signup.html"; // Redirige vers la connexion si non connecté
          return;
        }
  
        let product = {
          id: this.dataset.id,
          name: this.dataset.name,
          price: parseFloat(this.dataset.price),
          quantity: 1,
        };
  
        addToCart(product);
      });
    });
  
    function addToCart(product) {
      let index = cart.findIndex((item) => item.id === product.id);
  
      if (index !== -1) {
        cart[index].quantity += 1; // Augmente la quantité si déjà dans le panier
      } else {
        cart.push(product);
      }
  
      localStorage.setItem("cart", JSON.stringify(cart)); // Sauvegarde dans localStorage
      alert("Produit ajouté au panier !");
    }
  
    function checkUserLogin() {
      return localStorage.getItem("userLoggedIn") === "true"; // Simule une connexion
    }
  });
  