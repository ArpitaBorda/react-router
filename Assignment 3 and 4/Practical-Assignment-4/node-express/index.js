const express = require('express');
const cors = require('cors');

const app = express();

app.use(cors());

const users = [
    {id: 1, name: "John Doe", age: 20, course: "Computer Science"},
    {id: 2, name: "Jane Smith", age: 22, course: "Mathematics"}
];

app.get('/api/students', async (req, res) => {
    return res.json(users);
})
app.get('/', async (req, res) => {
    try {
        const response = await axios.get('http://localhost/Practical-Assignment-4/api_call.php');
        res.send(response.data);
    } catch (error) {
        res.status(500).send('Error calling PHP API');
    }
})

app.listen(3000);