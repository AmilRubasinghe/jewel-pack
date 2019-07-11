<template></template>

<script>
export default {
  data() {
    return {
      drawer: null,
      items: [
        { title: "Dashboard", icon: "dashboard", path: "" },
        { title: "Users", icon: "supervised_user_circle", path: "users" },
        { title: "Orders", icon: "library_books", path: "orders" },
        { title: "Products", icon: "business_center", path: "products" },
        { title: "Category", icon: "reorder", path: "category" },
        { title: "Reports", icon: "file_copy", path: "reports" },
        { title: "Slide Show", icon: "photo_library", path: "slideshow" }
      ]
    };
  }
};
</script>


