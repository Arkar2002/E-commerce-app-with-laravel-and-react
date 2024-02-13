import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  products: [],
};

const productSlice = createSlice({
  name: "product",
  initialState,
  reducers: {
    addProducts(state, action) {
      state.products = action.payload;
    },
  },
});

export default productSlice.reducer;

export const { addProducts } = productSlice.actions;

export const getProductsFromSlice = (store) => store.product.products;
