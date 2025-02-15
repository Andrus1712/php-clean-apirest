import {createSlice, PayloadAction} from "@reduxjs/toolkit";

interface UsersState {
    id?: number;
    name: string;
    email: string;
}

const initialState: UsersState = {
    id: 0,
    name: "",
    email: ""
}


export const usersSlice = createSlice({
    name: "Users",
    initialState,
    reducers: {
        setUser: (state, action: PayloadAction<UsersState>) => {
            state.id = action.payload.id;
            state.name = action.payload.name;
            state.email = action.payload.email;
        }
    },
});

export const {setUser} = usersSlice.actions;
export default usersSlice.reducer;
