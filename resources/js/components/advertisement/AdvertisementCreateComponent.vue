  
<template>
  <button v-on:click="Create_add()" class="btn btn-primary btn-icon-split">
    <span class="icon text-white-50">
      <i class="far fa-window-maximize"/>
    </span>
    <span class="text">Add Advertisement</span>
  </button>
</template>

<script>
export default {
  methods: {
      Create_add() {
      this.$swal
        .mixin(this.$root.MixinContent(["1", "2"]))
        .queue([
          {
            title: "Add a new advertisement.",
            text: "Select a file (just JPG or JPEG).",
            input: "file",
            inputValidator: (value) => {
              return new Promise((resolve) => {
                if (value == null) {
                  resolve("An image should be selected..");
                } else if (
                  (value.type == "image/png") |
                  (value.type == "image/jpeg")
                ) {
                  resolve();
                } else {
                  resolve("The image should be PNG or JPEG.");
                }
              });
            },
          },
          {
            title: "Add a new advertisement.",
            text: "Link(optional) to go when the images is clicked.",
            input: "text",
          },
        ])
        .then((result) => {
          if (result.value) {
            var fileReader = new FileReader();
            fileReader.readAsDataURL(result.value[0]);
            fileReader.onload = (e) => {
              this.Add(
                {
                  image_source: result.value[0].name,
                  link: result.value[1],
                  file: e.target.result,
                },
                result.value[0].size / 1024
              );
            };
          }
        });
    },
    Add(data, size) {
      this.$root.FileLoading(
         "<strong>Link: </strong>" +
          data.link +
          "<br><strong>Name(file): </strong>" +
          data.image_source +
          "<br><strong>Size: </strong>" +
          Math.round(size) +
          // TODO: Validate the size image
          " KB"
      );
      axios.post("api/advertisement", data).then(
        (response) => {
          this.$emit("create", response.data);
          this.$root.SuccessMessage(
            "Add created!",
            "In the main panel you could set an expiration date."
          );
        },
        (error) => {
          this.$root.ErrorMessage("", error);
        }
      );
    },
  },
};
</script>