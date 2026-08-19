import elections from './elections'
import votes from './votes'
import voterImports from './voter-imports'
import voters from './voters'
const resources = {
    elections: Object.assign(elections, elections),
votes: Object.assign(votes, votes),
voterImports: Object.assign(voterImports, voterImports),
voters: Object.assign(voters, voters),
}

export default resources