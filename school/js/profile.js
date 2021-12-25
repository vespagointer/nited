ClassicEditor.create(document.querySelector("#profile"), {
  ckfinder: {
    uploadUrl: "../ckupload.php",
  },
}).catch((error) => {
  console.error(error);
});
