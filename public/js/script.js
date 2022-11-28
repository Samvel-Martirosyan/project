// If the string has the same value at the beginning and end, the function returns true, otherwise false.
// Uppercase letters, lowercase letters, commas, asterisks, and similar symbols will also be taken into account.
// Example: 'ANNA' => true
function startEndChars (str) {
    return str[0] === str[str.length - 1];
}

startEndChars('ANNa');

// get all duplicate keys in objects
function duplicateKeys(arr) {
    let json = '';
    let obj = {};

    for(let i = 0; i < arr.length; i++) {
        json += JSON.stringify(Object.keys(arr[i]))
    }

    for(let i = 0; i < arr.length; i++) {
        for(let j = 0; j < Object.keys(arr[i]).length; j++) {
            const indices = [];
            const element = Object.keys(arr[i])[j];
            let idx = json.indexOf(element);
            while (idx !== -1) {
                indices.push(idx);
                idx = json.indexOf(element, idx + 1);
            }

            if (indices.length > 1) {
                obj[element] = indices.length;
            }
        }
    }

    return obj;
}

const arr = [
    {
        name: 'test',
        age: 18
    },
    {
        from: 'Gyumri',
        name: 'test'
    },
    {
        test: 'Gyumri',
        name: 'test'
    },
    {
        age: 'Gyumri',
        name: 'test'
    },
];

duplicateKeys(arr);


