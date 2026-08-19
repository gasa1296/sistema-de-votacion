import ListElections from './ListElections'
import CreateElection from './CreateElection'
import EditElection from './EditElection'

const Pages = {
    ListElections: Object.assign(ListElections, ListElections),
    CreateElection: Object.assign(CreateElection, CreateElection),
    EditElection: Object.assign(EditElection, EditElection),
}

export default Pages