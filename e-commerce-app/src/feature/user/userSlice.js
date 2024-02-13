import { createSlice } from "@reduxjs/toolkit";

const initialState = {
  auth: false,
};

const userSlice = createSlice({
  name: "user",
  initialState,
  reducers: {
    checkAuth(state, action) {
      state.auth = action.payload;
    },
  },
});

export default userSlice.reducer;

export const { checkAuth } = userSlice.actions;

export const getAuthStatus = (store) => store.user.auth;
