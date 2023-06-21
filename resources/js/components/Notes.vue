<template>
    <div class="d-flex justify-content-center align-items-center">
        <Form @add-new="addNote" />
    </div>
    <div class="card-container">
        <Card :notes="notes" />
    </div>
</template>

<script setup>
import { ref, watch } from "vue";
import Form from "./Form.vue";
import Card from "./Card.vue";

let id = 0;
const notes = ref([]);

const fetchNotes = async () => {
    try {
        const response = await axios.get("/api/notes");
        notes.value = response.data;
        notes.value.forEach((note) => {
            note.color = generateRandomColor();
        });
    } catch (error) {
        console.error(error);
    }
};

watch(notes, (newNotes) => {
    console.log("Updated notes:", newNotes);
});

fetchNotes();

const addNote = (newNote) => {
    const isInputEmpty = !newNote.text || !newNote.title;
    const isNoteAlreadyExists = notes.value.find(
        (note) => note.title === newNote.title
    );

    if (isInputEmpty) {
        alert("Isi semua input");
        return false;
    }

    if (isNoteAlreadyExists) {
        alert("Judul sudah ada, harap gunakan judul lain");
        return false;
    }

    notes.value.push({
        id: id++,
        title: newNote.title,
        text: newNote.text,
        color: generateRandomColor(),
    });
};

const generateRandomColor = () => {
    const letters = "0123456789ABCDEF";
    let color = "#";
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
};
</script>
