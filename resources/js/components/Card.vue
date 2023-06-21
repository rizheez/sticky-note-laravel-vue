<template>
    <div class="row mt-2 border-top border-dark anim">
        <transition-group name="fade">
            <div v-for="item in notes" :key="item.id" class="col-md-4">
                <div
                    class="card mt-2"
                    :style="{ backgroundColor: item.color }"
                    :class="{ 'hover-effect': isHovered }"
                    @mouseover="isHovered = true"
                    @mouseleave="isHovered = false"
                >
                    <div class="card-body">
                        <h5
                            class="card-title"
                            :style="getTitleStyle(item.color)"
                        >
                            Title: {{ item.title }}
                        </h5>
                        <p class="card-text" :style="getTextStyle(item.color)">
                            Text: {{ item.text }}
                        </p>
                    </div>
                </div>
            </div>
        </transition-group>
    </div>
</template>

<script setup>
import { defineProps, ref } from "vue";

function getTitleStyle(backgroundColor) {
    const brightness = getBrightness(backgroundColor);
    return {
        color: brightness > 128 ? "black" : "white",
    };
}

function getTextStyle(backgroundColor) {
    const brightness = getBrightness(backgroundColor);
    return {
        color: brightness > 128 ? "black" : "white",
    };
}

function getBrightness(color) {
    // Extract RGB values from color string
    const rgb = color.substring(1).match(/.{2}/g);
    const r = parseInt(rgb[0], 16);
    const g = parseInt(rgb[1], 16);
    const b = parseInt(rgb[2], 16);

    // Calculate brightness using formula (0.299 * R + 0.587 * G + 0.114 * B)
    return 0.299 * r + 0.587 * g + 0.114 * b;
}

defineProps({
    notes: {
        type: Array,
        required: true,
    },
});

const isHovered = ref(false);
</script>

<style>
.hover-effect {
    transition: transform 1.5s;
}

.hover-effect:hover {
    transform: translateY(-10px);
}

.anim {
    transition: transform 0.5s;
    transform: translate(-10px);
}

.fade-enter-active {
    animation: fade-in 1.5s;
}

.fade-leave-active {
    animation: fade-out 1.5s;
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

@keyframes fade-out {
    from {
        opacity: 1;
    }
    to {
        opacity: 0;
    }
}
</style>
