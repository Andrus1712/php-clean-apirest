import {Provider} from "react-redux";
import {persistor, store} from "./features";
import {PersistGate} from "redux-persist/integration/react";
import {BrowserRouter, Route, Routes} from "react-router-dom";
import RequireAuth from "./guard/RequireAuth.tsx";
import LoginView from "./views/public/loginView.tsx";
import Dashboard from "./views/private/Dashboard.tsx";

function App() {
    return (
        <Provider store={store}>
            <PersistGate persistor={persistor}>
                <BrowserRouter>
                    <Routes>
                        <Route path="*" element={<>Not found</>}/>
                        <Route path={"/"} element={<LoginView/>}/>
                        <Route path={"/login"} element={<LoginView/>}/>
                        
                        <Route element={<RequireAuth/>}>
                            <Route path="/dashboard" element={<Dashboard/>}/>
                        </Route>
                    </Routes>
                </BrowserRouter>
            </PersistGate>
        </Provider>
    )
}

export default App
