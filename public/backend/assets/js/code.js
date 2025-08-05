// $(function () {
//     $(document).on("click", "#delete", function (e) {
//         e.preventDefault();
//         var link = $(this).attr("href");

//         Swal.fire({
//             title: "Apakah anda yakin?",
//             text: "Hapus data?",
//             icon: "warning",
//             showCancelButton: true,
//             confirmButtonColor: "#3085d6",
//             cancelButtonColor: "#d33",
//             confirmButtonText: "Ya, hapus!",
//         }).then((result) => {
//             if (result.isConfirmed) {
//                 window.location.href = link;
//                 Swal.fire("Deleted!", "Your file has been deleted.", "success");
//             }
//         });
//     });
// });

function confirmDelete(id) {
    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data akan dihapus secara permanen.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Ya, hapus!",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + id).submit();
        }
    });
}
