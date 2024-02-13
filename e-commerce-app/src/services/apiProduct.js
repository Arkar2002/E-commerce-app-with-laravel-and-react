import { axiosClient } from "./axiosClient";

export async function getProducts(
  pageParam,
  { field, direction },
  categories,
  brands,
) {
  const { data } = await axiosClient.get(
    `/products?page=${pageParam}&sortBy[${field}]=${direction}&categories=${categories}&brands=${brands}`,
  );
  return data;
}

export async function getProductDetails(slug) {
  const {
    data: { data },
  } = await axiosClient.get(`/products/${slug}`);
  return data;
}

export async function addToCart(data) {
  await axiosClient.post("addToCart", data);
}

export async function getCarts() {
  const { data } = await axiosClient.get("carts");
  return data;
}

export async function addProductLike(data) {
  await axiosClient.post("product-likes", data);
}

export async function removeProductLike(data) {
  await axiosClient.post("product-unlikes", data);
}
