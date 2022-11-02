import React, { useState } from "react";
import Select from "react-select";

const App = () => {
    const [userName, setUserName] = useState<string | null>(null);

    const users = [
        {
            value: "1",
            label: "Zehner Scott",
        },
        {
            value: "2",
            label: "Zeiser Petersson",
        },
        {
            value: "3",
            label: "Yule Lindberg",
        },
        {
            value: "4",
            label: "Yanosh Pettersson",
        },
        {
            value: "5",
            label: "Zurawicz Jensen",
        },
        {
            value: "6",
            label: "Zielke Hagen",
        },
        {
            value: "7",
            label: "Zappa Kristiansen",
        },
        {
            value: "8",
            label: "Zorn Pedersen",
        },
        {
            value: "9",
            label: "Zenz Robinson",
        },
        {
            value: "10",
            label: "Zaruba Jansson",
        },
    ];

    const selectUser = (e) => {
        console.log(e)
        setUserName(e.label);
    }

    const selectStyle = {
        control: () => {
            return {
                width: '200px',
                margin: '5px',
                borderWidth: '2px',
                borderColor: 'black',
                display: 'flex',
            };
        },
    };

    return (
        <div>
            <Select options={users}
                    onChange={selectUser}
                    styles={selectStyle}
            />

            <span>User Name: {userName}</span>
        </div>
    );
};

export default App;
