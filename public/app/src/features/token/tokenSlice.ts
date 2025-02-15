import {createSlice, PayloadAction} from "@reduxjs/toolkit";

interface TokenState {
    value: string;
}

const initialState: TokenState = {
    value: "",
};
export const tokenSlice = createSlice({
    name: "Token",
    initialState,
    reducers: {
        add_Token: (state, action: PayloadAction<string>) => {
            state.value = action.payload;
        },
        clear_Tokens: (state) => {
            state.value = "";
        },
    },
});
export const {add_Token, clear_Tokens} = tokenSlice.actions;
export default tokenSlice.reducer;
