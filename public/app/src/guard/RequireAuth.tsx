import {Outlet} from "react-router-dom";
import {useAppSelector} from "../hooks";
import Layout from "../layout/Layout.tsx";

const RequireAuth = () => {
    
    const {value: _token} = useAppSelector(state => state.token);
    return <>
        <Layout>
            {_token}
            <Outlet/>
        </Layout>
    </>;
    // return _token ?
    //     <Layout>
    //         <Outlet/>
    //     </Layout>
    //     :
    //     <Navigate to="/login" replace/>;
};

export default RequireAuth;
