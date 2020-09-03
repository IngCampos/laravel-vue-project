  
<template>
  <tr>
    <td class="align-middle">{{complaint.created_at | date}}</td>
    <td>
      <strong>{{complaint.name}}</strong>
      <br />
      {{complaint.email}}
    </td>
    <td class="align-middle text-center">
      <span
        v-if="complaint.complaint_type_id=='1'"
        class="badge badge-danger"
      >{{complaint.complaint_type.name}}</span>
      <span
        v-else-if="complaint.complaint_type_id=='2'"
        class="badge badge-success"
      >{{complaint.complaint_type.name}}</span>
      <span
        v-else-if="complaint.complaint_type_id=='3'"
        class="badge badge-info"
      >{{complaint.complaint_type.name}}</span>
    </td>
    <td class="align-middle text-right">
      <button v-on:click="Show_info()" class="btn btn-info">
        <i class="fas fa-info-circle"></i>
      </button>
      <a
        class="btn btn-success"
        :href="'mailto:'+complaint.email+'?Subject=Contestación%20de%20'+complaint.complaint_type.name+':'"
      >
        <i class="fas fa-envelope"></i>
      </a>
      <button v-on:click="$emit('delete', complaint.id)" class="btn btn-danger">
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