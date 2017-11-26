<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"> </script>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>
</head>
<body>
<form action="db.php" method="post">
<table>
  <tr>
    <th>Sl. No.</th>
    <th>Product Name</th>
    <th>Quantity</th>
    <th>Cost</th>
    <th>Amount</th>
  </tr>
  
  <tr class="data">
    <td><input name="data[1][sl_no]" type="text" value="1"></td>
    <td><input name="data[1][product_name]" type="text"></td>
    <td><input name="data[1][quantity]" type="text" class="price-changer"></td>
    <td><input name="data[1][cost]" type="text" class="price-changer"></td>
    <td><input name="data[1][amount]" type="text" value="0"></td>
  </tr>
  
  
  
</table>
<input type="button" class="add-row" value="Add">
<!-- <input type="button" class="calculate-price" value="Calculate Price"> -->
<h4 class="total-price">Rs 0</h4>
<br>
<input type="submit" value="SUBMIT">
</form>
</body>

<script>
$(document).ready(function(){
	$('input.add-row').click(function(){
		var rows=$('tr.data');
		var row_no=rows.length + 1;
		
		var elem_str = "";
		elem_str += '<tr class="data">';
		elem_str += '<td><input name="data[' + row_no + '][sl_no]" type="text" value="' + row_no + '"></td>';
		elem_str += '<td><input name="data[' + row_no + '][product_name]" type="text"></td>';
		elem_str += '<td><input name="data[' + row_no + '][quantity]" type="text" class="price-changer"></td>';
		elem_str += '<td><input name="data[' + row_no + '][cost]" type="text" class="price-changer"></td>';
		elem_str += '<td><input name="data[' + row_no + '][amount]" type="text" value="0"></td>';
		elem_str += '</tr>';

		$('table').append(elem_str);

		$('input.price-changer').change(calculateSum);
	});

	$('input.calculate-price').click(calculateSum);
	$('input.price-changer').change(calculateSum);
});

var calculateSum = function() {
	var rows = $('tr.data');
	var total_price = 0;
	// for (var i = 0; i < rows.length; i++) {
	// 	var row_no = i + 1;
	// 	var quantity = $('input[name="data[][quantity]"]').val();
	// 	var cost = $('input[name="data[][cost]"]').val();
	// 	if (quantity && cost && !isNaN(quantity) && !isNaN(cost)) {
	// 		total_price += parseFloat(quantity) * parseFloat(cost);
	// 		$('input[name="data[][amount]"]:eq(' + (row_no - 1) + ')').val(parseFloat(quantity) * parseFloat(cost));
	// 	} else {
	// 		$('input[name="data[][amount]"]:eq(' + (row_no - 1) + ')').val('0');
	// 	}
	// }
	$('tr.data').each(function() {
		var row_no = $(this).find('td:eq(0)').find('input').val();
		var quantity = $(this).find('input[name="data[' + row_no + '][quantity]"]').val();
		var cost = $(this).find('input[name="data[' + row_no + '][cost]"]').val();
		if (quantity && cost && !isNaN(quantity) && !isNaN(cost)) {
			total_price += parseFloat(quantity) * parseFloat(cost);
			$(this).find('input[name="data[' + row_no + '][amount]"]').val(parseFloat(quantity) * parseFloat(cost));
		} else {
			$(this).find('input[name="data[' + row_no + '][amount]"]').val('0');
		}
	});

	$('.total-price').text('Rs ' + total_price);
};
</script>
</html>