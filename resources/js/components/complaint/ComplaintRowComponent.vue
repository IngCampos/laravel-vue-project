  
<template>
  <tr>
    <td>{{complaint.created_at | date}}</td>
    <td>
      <strong>{{complaint.name}}</strong>
      <br />
      {{complaint.email}}
    </td>
    <td class="text-center">
      <span
        :class="'badge badge-'+(complaint.complaint_type.id == 1 ? 'success' 
        : (complaint.complaint_type.id == 2 ? 'danger' : 'info'))"
      >{{complaint.complaint_type.name}}</span>
    </td>
    <td class="col-action-3">
      <button v-on:click="Show_info()" class="btn btn-info btn-circle">
        <i class="fas fa-info-circle"></i>
      </button>
      <a
        class="btn btn-success btn-circle"
        :href="'mailto:'+complaint.email+'?Subject=Answer%20of%20'+complaint.complaint_type.name+':'"
      >
        <i class="fas fa-envelope"></i>
      </a>
      <button v-on:click="$emit('delete', complaint.id)" class="btn btn-danger btn-circle">
        <i class="far fa-trash-alt"></i>
      </button>
    </td>
  </tr>
</template>

<script>
export default {
  props: ["complaint"],
  methods: {
    Show_info() {
      const date = this.$options.filters.date;
      this.$root.InfoMessage(
        this.complaint.complaint_type.name,
        "<strong>Name</strong>: " +
          this.complaint.name +
          "<br><strong>Email</strong>: " +
          this.complaint.email +
          "<br><strong>Date</strong>: " +
          date(this.complaint.created_at) +
          "<br><strong>Content</strong>: " +
          this.complaint.content
      );
    },
  },
};
</script>