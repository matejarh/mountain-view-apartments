<template>
    <div>
      <ul>
        <li v-for="(item, index) in items" :key="index">
          {{ item.name }}
          <button @click="moveUp(index)" :disabled="index === 0">Move Up</button>
          <button @click="moveDown(index)" :disabled="index === items.length - 1">Move Down</button>
        </li>
      </ul>
    </div>
  </template>

  <script>
  import { ref } from 'vue';

  export default {
    setup() {
      // Define the list of items
      const items = ref([
        { name: 'Item 1' },
        { name: 'Item 2' },
        { name: 'Item 3' }
      ]);

      // Function to move an item up
      const moveUp = (index) => {
        if (index > 0) {
          const temp = items.value[index];
          items.value.splice(index, 1);
          items.value.splice(index - 1, 0, temp);
        }
      };

      // Function to move an item down
      const moveDown = (index) => {
        if (index < items.value.length - 1) {
          const temp = items.value[index];
          items.value.splice(index, 1);
          items.value.splice(index + 1, 0, temp);
        }
      };

      return {
        items,
        moveUp,
        moveDown
      };
    }
  };
  </script>
