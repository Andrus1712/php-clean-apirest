import {configureStore} from "@reduxjs/toolkit";
import {combineReducers} from "redux";
import {FLUSH, PAUSE, PERSIST, persistReducer, persistStore, PURGE, REGISTER, REHYDRATE,} from "redux-persist";
import {Persistor} from "redux-persist/es/types";
import storage from "redux-persist/lib/storage";
import {authApi} from "../../api/auth/authApi.ts";
import {expirationMiddleware} from "../../middleware/expirationMiddleware.ts";
import {tokenSlice} from "./token/tokenSlice.ts";
import {usersSlice} from "./user/userSlice.ts";


const persistConfig = {
    key: "root",
    storage,
    whitelist: ["token", "users"],
};

const rootReducer = combineReducers({
    token: tokenSlice.reducer,
    users: usersSlice.reducer,
    [authApi.reducerPath]: authApi.reducer,
});

const persistedReducer = persistReducer(persistConfig, rootReducer);

const store = configureStore({
    reducer: persistedReducer,
    middleware: (getDefaultMiddleware) =>
        getDefaultMiddleware({
            serializableCheck: {
                ignoredActions: [FLUSH, REHYDRATE, PAUSE, PERSIST, PURGE, REGISTER],
            },
        }).concat(authApi.middleware, expirationMiddleware),
});

const persistor: Persistor = persistStore(store);

export type RootState = ReturnType<typeof store.getState>;
export type AppDispatch = typeof store.dispatch;
export {persistor, store};
