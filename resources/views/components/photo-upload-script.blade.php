<script>
    let openInput = () => document.querySelector(".photoInput").click();

    let photoInput = document.querySelector(".photoInput").addEventListener("change", (e) => {
        if (e.target.files.length > 0) {
            let photo = e.target.files[0];
            let fileReader = new FileReader();
            fileReader.onload = (e) => {
                document.querySelector("[selectPhotoContainer]").innerHTML = `
    <img src="${e.target.result}" class="w-100 text-center rounded">
        <div editIcon style="width:50px;height:50px;border-radius:50%;top: 50%;right:-5%;transform: translateY(-50%);cursor: pointer;" class="border border-white shadow text-center position-absolute bg-light">
            <i class="bi bi-pen-fill text-success" style="line-height:50px;"></i>
        </div>
    `;
            };
            fileReader.readAsDataURL(photo);
        }
    });

    $("[selectPhotoContainer]").delegate("[editIcon]", "click", () => openInput());
</script>
