<script setup>
import axios from "axios";

let note = {
    id: "",
    title: "",
    text: "",
};

const emit = defineEmits(["add-new"]);

const addNewNote = async () => {
    try {
        const response = await axios.post("/api/notes", {
            title: note.title,
            text: note.text,
        });
        emit("add-new", response.data);
        resetForm();
    } catch (error) {
        console.error(error);
    }
};

const resetForm = () => {
    note = {
        id: "",
        title: "",
        text: "",
    };
    const form = document.querySelector("form");
    form.reset();
};
</script>

<template>
    <div class="card border" style="width: 30rem">
        <div class="card-body">
            <h5 class="card-title">Sticky Note APP</h5>
            <form @submit.prevent="addNewNote">
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input
                        type="text"
                        class="form-control"
                        name="title"
                        id="title"
                        v-model="note.title"
                        placeholder="Input title"
                    />
                </div>
                <div class="mb-3">
                    <label for="text" class="form-label">Text</label>
                    <textarea
                        class="form-control"
                        id="text"
                        v-model="note.text"
                        name="text"
                        rows="3"
                    ></textarea>
                </div>
                <button class="btn btn-primary">Add Note</button>
            </form>
        </div>
    </div>
</template>
