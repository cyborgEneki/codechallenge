<template>
  <div>
    <SidebarAndList />
  </div>
</template>

<script>
import SidebarAndList from "./SidebarAndList";

export default {
  components: {
    SidebarAndList
  },
  data() {
    return {
      choices: []
    }
  },
  methods: {
    getChoices() {
      axios.get("/api/choices".then(response => {
        this.choices = response.data;
      }))
    }
  },
  mounted() {
    this.getChoices();
  }
};
</script>
