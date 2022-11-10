import categoryData from "../category.json" assert {type: "json"};
import brandData from "../brand.json" assert {type: "json"};
const category = document.getElementById('category');
const brand = document.getElementById('brand');
categoryData.forEach((item) => {
    const option = document.createElement('option');
    option.value = item;
    option.innerText = item;
    category.appendChild(option);
});
export function updateBrand(value){
    brandData[value].forEach((item) => {
        const option = document.createElement('option');
        option.value = item;
        option.innerText = item;
        brand.appendChild(option);
    });
}
category.addEventListener('change', (e) => {
    [...brand.children].forEach((item, index) => index !== 0 ? item.remove() : null);
    updateBrand(e.target.value);
});