import "./bootstrap.js";
import * as bootstrap from 'bootstrap';

const sortableList = document.querySelector(".tasks-list");
const items = sortableList.querySelectorAll(".item");


items.forEach(item => {
    item.addEventListener("dragstart", () => {
        // Adding dragging class to an item after a delay
        setTimeout(() => item.classList.add("dragging"), 0);
    });

    item.addEventListener("dragend", function () {
        item.classList.remove("dragging");

        var id = $(item).data("id");
        console.log($(item).index())

        $.ajax({
            type: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/tasks/' + id + '/reorder',
            data: { "priority":  $(item).index()},
            success: function( data ) {
                // console.log(data);
            }
        });
    });

});

const initSortableList = (e) => {
    e.preventDefault();
    const draggingItem = document.querySelector(".dragging");
    // Getting all items except currently dragging and making an array of them
    let siblings = [...sortableList.querySelectorAll(".item:not(.dragging)")];

    // Finding the sibling after which the dragging item should be placed
    let nextSibling = siblings.find(sibling => {
        return e.clientY <= sibling.offsetTop + sibling.offsetHeight / 2;
    });

    // Inserting the dragging item before the found sibling
    sortableList.insertBefore(draggingItem, nextSibling);
}

sortableList.addEventListener("dragover", initSortableList);
sortableList.addEventListener("dragenter", e => e.preventDefault());

$(document).ajaxSuccess(function () {
    window.location.reload();
});

const editTask = document.getElementById('editTask')
if (editTask) {
    editTask.addEventListener('show.bs.modal', event => {

        const button = event.relatedTarget

        const id = button.getAttribute('data-bs-id');

        $("#editForm").attr("action", "/tasks/" + id);

        const name = button.getAttribute('data-bs-name');
        const priority = button.getAttribute('data-bs-priority');
        const date = button.getAttribute('data-bs-date');


        // Update the modal's content.

        const modalNameInput = editTask.querySelector('.modal-body input[name="name"]');
        const modalPriorityInput = editTask.querySelector('.modal-body input[name="priority"]');
        const modalDateInput = editTask.querySelector('.modal-body input[name="date"]');


        modalNameInput.value = name;
        modalPriorityInput.value = priority;
        modalDateInput.value = date;
    })
}
