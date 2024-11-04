const calPrice = (i, curPrice, length) => {
  var qty = document.getElementById("qty" + i.toString());

  var regex = /^[\d]*$/;

  if (!regex.test(qty.value)) {
    alert("Invalid quantity.");
    qty.value = 0;
  }

  var total = document.getElementById("total" + i.toString());
  total.value = (qty.value * curPrice).toFixed(2);

  calTotal(length);
};

const calTotal = (length) => {
  var totalPrice = document.getElementById("total");
  totalPrice.value = "0.00";

  for (var i = 0; i < length; i++) {
    var total = document.getElementById("total" + i.toString());
    totalPrice.value = (
      parseFloat(totalPrice.value) + parseFloat(total.value)
    ).toFixed(2);
  }

  return totalPrice.value;
};

window.onload = function () {
  calTotal(Number.MAX_SAFE_INTEGER);
};
