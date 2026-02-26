const orderPizza = (type) => {

    return new Promise((resolve, reject) => {

        console.log("Ordering Pizza... 🍕");

        setTimeout(() => {

            const menu = ["Margherita", "Veg Supreme", "Pepperoni"];

            if (menu.includes(type)) {
                resolve(`✅ ${type} Pizza is Ready!`);
            } 
            else {
                reject(`❌ ${type} is Not Available!`);
            }

        }, 3000);

    });
};


// Test Available Pizza
orderPizza("Margherita")
    .then(result => console.log(result))
    .catch(error => console.log(error));


// Test Unavailable Pizza
orderPizza("Chicken Tikka")
    .then(result => console.log(result))
    .catch(error => console.log(error));
