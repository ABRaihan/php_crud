const category = document.getElementById('category');
const brand = document.getElementById('brand');
const formData = new FormData();
const postData = async function(data){
    const res = await fetch('response.php', {
        method: 'POST',
        body: data
    });
    return await res.text();
}
category.addEventListener('change', async (e) => {
    formData.append('id', e.target.selectedIndex);
    const brandHtml = await postData(formData);
    brand.innerHTML = brandHtml;
});