$(document).ready(function () {
  fetchData();

  //initializa datatables
  let table = new DataTable("#myTable");

  $("input.image").change(function () {
    var file = this.files[0];
    var url = URL.createObjectURL(file);
    $(this).closest(".row").find(".preview_img").attr("src", url);
  });

  // function to fetch data from database
  function fetchData() {
    $.ajax({
      url: "server.php?action=fetchData",
      type: "POST",
      dataType: "json",
      success: function (response) {
        var data = response.data;
        table.clear().draw();
        $.each(data, function (index, value) {
          table.row.add([
            value.User_Id,
            value.First_Name,
            value.Last_Name,
            '<img src="uploads/' + value.Image + '" style="width:50px;height:50px;border:2px solid gray;border-radius:8px;object-fit:cover">',
            value.Email,
            value.Country,
            value.Gender,
            '<Button type="button" class="btn editBtn" value="' + value.User_Id + '"><i class="fa-solid fa-pen-to-square fa-xl"></i></Button>' +
            '<Button type="button" class="btn deleteBtn" value="' + value.User_Id + '"><i class="fa-solid fa-trash fa-xl"></i></Button>' +
            '<input type="hidden" class="delete_image" value="' + value.Image + '">'
          ]).draw(false);
        })
      }
    })
  }

  // function to insert data to database
  $("#insertForm").on("submit", function (e) {
    $("#insertBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "server.php?action=insertData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          $("#offcanvasAddUser").offcanvas("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if (response.statusCode == 500) {
          $("#offcanvasAddUser").offcanvas("hide");
          $("#insertBtn").removeAttr("disabled");
          $("#insertForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if (response.statusCode == 400) {
          $("#insertBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        }
      }
    });
  });

  // function to edit data in form
  $("#myTable").on("click", ".editBtn", function () {
    var id = $(this).val();
    console.log(id);
    $.ajax({
      url: "server.php?action=fetchSingle",
      type: "POST",
      dataType: "json",
      data: {
        id: id
      },
      success: function (response) {
        var data = response.data;
        $("#editForm #id").val(data.User_Id);
        $("#editForm input[name='first_name']").val(data.First_Name);
        $("#editForm input[name='last_name']").val(data.Last_Name);
        $("#editForm input[name='email']").val(data.Email);
        $("#editForm select[name='country']").val(data.Country);
        $("#editForm .preview_img").attr("src", "uploads/" + data.Image + "");
        $("#editForm #image_old").val(data.Image);
        if (data.Gender === "male") {
          $("#editForm input[name='gender'][value='male']").attr("checked", true);
        } else if (data.Gender === "female") {
          $("#editForm input[name='gender'][value='female']").attr("checked", true);
        }
        // show the edit user offcanvas
        $("#offcanvasEditUser").offcanvas("show");
      }
    });
  });

  // function to uppdate data to database
  $("#editForm").on("submit", function (e) {
    $("#editBtn").attr("disabled", "disabled");
    e.preventDefault();
    $.ajax({
      url: "server.php?action=updateData",
      type: "POST",
      data: new FormData(this),
      contentType: false,
      cache: false,
      processData: false,
      success: function (response) {
        var response = JSON.parse(response);
        if (response.statusCode == 200) {
          $("#offcanvasEditUser").offcanvas("hide");
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#successToast").toast("show");
          $("#successMsg").html(response.message);
          fetchData();
        } else if (response.statusCode == 500) {
          $("#offcanvasEditUser").offcanvas("hide");
          $("#editBtn").removeAttr("disabled");
          $("#editForm")[0].reset();
          $(".preview_img").attr("src", "images/default_profile.jpg");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);
        } else if (response.statusCode == 400) {
          $("#editBtn").removeAttr("disabled");
          $("#errorToast").toast("show");
          $("#errorMsg").html(response.message);

        }
      }
    });
  });
  // function to delete data
  $("#myTable").on("click", ".deleteBtn", function () {
    if (confirm("Are you sure you want to delete this user?")) {
      var id = $(this).val();
      var delete_image = $(this).closest("td").find(".delete_image").val();
      $.ajax({
        url: "server.php?action=deleteData",
        type: "POST",
        dataType: "json",
        data: {
          id,
          delete_image
        },
        success: function (response) {
          if (response.statusCode == 200) {
            fetchData();
            $("#successToast").toast("show");
            $("#successMsg").html(response.message);
          } else if (response.statusCode == 500) {
            $("#errorToast").toast("show");
            $("#errorMsg").html(response.message);
          }
        }
      })
    }
  })
})