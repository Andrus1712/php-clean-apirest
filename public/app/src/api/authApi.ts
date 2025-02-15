import {createApi, fetchBaseQuery} from '@reduxjs/toolkit/query/react';
import {RootState} from "../features";

interface ResponseAuth {
    token: string;
}

interface Ilogin {
    email: string;
    password: string;
}

export const authApi = createApi({
    reducerPath: 'authApi',
    baseQuery: fetchBaseQuery(
        {
            baseUrl: 'http://localhost:9000',
            prepareHeaders: (headers, {getState}) => {
                const token = (getState() as RootState).token.value;
                if (token) {
                    headers.set("Authorization", `Bearer ${token}`);
                }
                return headers;
            },
        }),
    endpoints: (builder) => ({
        authUser: builder.mutation<ResponseAuth, Ilogin>({
            query: (data: Ilogin) => ({
                url: "/auth/login",
                method: "POST",
                body: data,
            }),
        }),
    }),
    
});

export const {useAuthUserMutation} = authApi;
