<template>
  <div>
    <span
      class="inline-block rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2 mb-2"
      :class="colorClass"
    >
      {{ text }}
    </span>
  </div>
</template>

<script>
export default {
  props: {
    candidateStatus: String,
  },

  computed: {
    text() {
      return this.getText();
    },
    colorClass() {
      return this.getColorClass();
    },
  },

  methods: {
    getText() {
      const texts = {
        none: "Initial",
        contacted: "Contacted",
        hired: "Hired",
      };

      return texts[this.candidateStatus] ?? "Initial";
    },
    getColorClass() {
      const colors = {
        none: "bg-slate-400",
        contacted: "bg-sky-400",
        hired: "bg-green-400",
      };

      return colors[this.candidateStatus] ?? "bg-slate-400";
    },
  },
};
</script>
