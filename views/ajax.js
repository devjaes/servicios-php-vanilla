const loadData = () => {
  $.ajax({
    url: "../controllers/studentController.php",
    type: "GET",
    dataType: "json",
    success: (response) => {
      const table = $("#table_rows");
      table.empty();
      $.each(response, (_, item) => {
        table.append(`
          <tr class="cursor-pointer hover:bg-gray-200" id="${item.dni}">
            <td class="p-3 text-sm text-gray-700">${item.dni}</td>
            <td class="p-3 text-sm text-gray-700">${item.name}</td>
            <td class="p-3 text-sm text-gray-700">${item.last_name}</td>
            <td class="p-3 text-sm text-gray-700">${item.address}</td>
            <td class="p-3 text-sm text-gray-700">${item.phone}</td>
            <td class="p-3 text-sm text-gray-700"><button onclick="deleteRow('${item.dni}')" class="text-red-700 hover:text-red-700">Eliminar 🗑</button></td>
          </tr> 
          `);
      });
    },
  });
};

const cleanInputs = () => {
  $("#dni").val("");
  $("#name").val("");
  $("#last_name").val("");
  $("#address").val("");
  $("#phone").val("");
};

const deleteRow = (dni) => {
  $.ajax({
    url: `../controllers/studentController.php?dni=${dni}`,
    type: "DELETE",
    success: (evt) => {
      loadData();
    },
  });
};

$(document).ready(() => {
  loadData();

  $("#create_button").click((evt) => {
    evt.preventDefault();
    const dni = $("#dni").val();
    const name = $("#name").val();
    const last_name = $("#last_name").val();
    const address = $("#address").val();
    const phone = $("#phone").val();

    $.ajax({
      url: "../controllers/studentController.php",
      type: "POST",
      data: { dni, name, last_name, address, phone },
      success: (res) => {
        console.log(res);
        cleanInputs();
        loadData();
      },
    });
  });

  $("#table_rows").on("click", "tr", function () {
    const dni = $(this).find("td:eq(0)").text();
    const name = $(this).find("td:eq(1)").text();
    const last_name = $(this).find("td:eq(2)").text();
    const address = $(this).find("td:eq(3)").text();
    const phone = $(this).find("td:eq(4)").text();

    $('input[name="dni"]').val(dni);
    $('input[name="name"]').val(name);
    $('input[name="last_name"]').val(last_name);
    $('input[name="address"]').val(address);
    $('input[name="phone"]').val(phone);
  });

  $("#update_button").click((evt) => {
    evt.preventDefault();

    const dni = $("#dni").val();
    const name = $("#name").val();
    const last_name = $("#last_name").val();
    const address = $("#address").val();
    const phone = $("#phone").val();

    $.ajax({
      url: `../controllers/studentController.php?dni=${dni}&name=${name}&last_name=${last_name}&address=${address}&phone=${phone}`,
      type: "PUT",
      success: function () {
        cleanInputs();
        loadData();
      },
    });
  });
});
